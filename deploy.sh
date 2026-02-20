#!/bin/bash

###############################################################################
# Kanji-Back Deployment Script
# Usage: ./deploy.sh <environment> <remote-host> <remote-user> <remote-path>
# Example: ./deploy.sh production server.com deploy /var/www/kanji-back
###############################################################################

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check arguments
if [ $# -lt 4 ]; then
    echo -e "${RED}Usage: $0 <environment> <remote-host> <remote-user> <remote-path>${NC}"
    echo "Example: $0 production server.com deploy /var/www/kanji-back"
    exit 1
fi

ENVIRONMENT=$1
REMOTE_HOST=$2
REMOTE_USER=$3
REMOTE_PATH=$4

echo -e "${YELLOW}========== Kanji-Back Deployment ==========${NC}"
echo "Environment: $ENVIRONMENT"
echo "Remote Host: $REMOTE_HOST"
echo "Remote User: $REMOTE_USER"
echo "Remote Path: $REMOTE_PATH"
echo ""

# Verify we're in the right directory
if [ ! -f "composer.json" ]; then
    echo -e "${RED}Error: composer.json not found. Run this script from the project root.${NC}"
    exit 1
fi

echo -e "${YELLOW}[1/5] Checking git status...${NC}"
if ! git diff-index --quiet HEAD --; then
    echo -e "${RED}Error: Uncommitted changes detected. Please commit or stash changes.${NC}"
    exit 1
fi
echo -e "${GREEN}✓ Git status clean${NC}"

echo -e "${YELLOW}[2/5] Creating deployment archive...${NC}"
DEPLOY_DIR=$(mktemp -d)
ARCHIVE_NAME="kanji-back-$(date +%Y%m%d-%H%M%S).tar.gz"

# Copy files to temp directory (excluding vendor and other unnecessary files)
rsync -a --exclude=vendor/ \
         --exclude=.git \
         --exclude=.gitignore \
         --exclude=node_modules \
         --exclude=tests/ \
         --exclude=.env.local \
         --exclude=*.log \
         --exclude=tmp/cache/* \
         --exclude=tmp/logs/* \
         --exclude=.DS_Store \
         --exclude=deploy.sh \
         ./ "$DEPLOY_DIR/"

# Create archive
cd "$DEPLOY_DIR"
tar -czf "$ARCHIVE_NAME" .
ARCHIVE_PATH="$DEPLOY_DIR/$ARCHIVE_NAME"
echo -e "${GREEN}✓ Archive created: $ARCHIVE_NAME${NC}"

echo -e "${YELLOW}[3/5] Uploading to server...${NC}"
scp "$ARCHIVE_PATH" "$REMOTE_USER@$REMOTE_HOST:/tmp/$ARCHIVE_NAME"
echo -e "${GREEN}✓ Upload complete${NC}"

echo -e "${YELLOW}[4/5] Deploying on server...${NC}"
ssh "$REMOTE_USER@$REMOTE_HOST" << 'REMOTE_COMMANDS'
    set -e
    ARCHIVE_NAME=$1
    REMOTE_PATH=$2
    ENVIRONMENT=$3
    
    echo "Creating backup..."
    if [ -d "$REMOTE_PATH" ]; then
        BACKUP_PATH="$REMOTE_PATH.backup.$(date +%Y%m%d-%H%M%S)"
        cp -r "$REMOTE_PATH" "$BACKUP_PATH"
        echo "Backup created at: $BACKUP_PATH"
    fi
    
    echo "Extracting archive..."
    mkdir -p "$REMOTE_PATH"
    cd "$REMOTE_PATH"
    tar -xzf "/tmp/$ARCHIVE_NAME" --strip-components=0
    
    echo "Installing PHP dependencies..."
    composer install --no-dev --optimize-autoloader --no-interaction
    
    echo "Setting permissions..."
    chmod -R 755 ./bin
    chmod -R 755 ./webroot
    chmod -R 775 ./tmp
    chmod -R 775 ./logs
    
    echo "Clearing cache..."
    rm -rf ./tmp/cache/*
    
    echo "Deployment complete!"
REMOTE_COMMANDS "$ARCHIVE_NAME" "$REMOTE_PATH" "$ENVIRONMENT"

echo -e "${GREEN}✓ Server deployment complete${NC}"

echo -e "${YELLOW}[5/5] Cleaning up...${NC}"
rm -rf "$DEPLOY_DIR"
echo -e "${GREEN}✓ Cleanup complete${NC}"

echo ""
echo -e "${GREEN}========== Deployment Successful! ==========${NC}"
echo -e "${GREEN}Application deployed to: $REMOTE_PATH${NC}"

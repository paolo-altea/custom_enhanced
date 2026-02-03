#!/bin/bash

# Build script for mod_custom_enhanced Joomla module
# Generates an installable ZIP package containing the module

set -e

# Get the project root directory (parent of build/)
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

# Configuration
MODULE_NAME="mod_custom_enhanced"
MODULE_DIR="$PROJECT_ROOT/src"
VERSION=$(grep '<version>' "$MODULE_DIR/$MODULE_NAME.xml" | sed 's/.*<version>\(.*\)<\/version>.*/\1/' || echo "1.0.0")
BUILD_DIR="$PROJECT_ROOT/dist"
ZIP_NAME="${MODULE_NAME}-${VERSION}.zip"

# Colors for output
GREEN='\033[0;32m'
NC='\033[0m'

echo "Building ${MODULE_NAME} v${VERSION}..."

# Create/clean build directory
rm -rf "$BUILD_DIR/tmp"
mkdir -p "$BUILD_DIR/tmp"

# Copy module files
cp -r "$MODULE_DIR/"* "$BUILD_DIR/tmp/"

# Create module ZIP
cd "$BUILD_DIR/tmp"
zip -rq "../$ZIP_NAME" . -x "*.DS_Store" -x "*__MACOSX*"

# Cleanup
cd "$PROJECT_ROOT"
rm -rf "$BUILD_DIR/tmp"

echo -e "${GREEN}✓ Build complete: dist/${ZIP_NAME}${NC}"

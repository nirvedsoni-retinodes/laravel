#!/bin/bash

echo "🔍 Verifying PHP syntax..."

# Check if PHP is available
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not available. Skipping syntax check."
    exit 0
fi

echo "✅ PHP found, checking syntax..."

# Find all PHP files
php_files=$(find . -name "*.php" -type f)

error_count=0

for file in $php_files; do
    # Skip vendor directory if it exists
    if [[ $file == *"/vendor/"* ]]; then
        continue
    fi
    
    # Check PHP syntax
    if php -l "$file" > /dev/null 2>&1; then
        echo "✅ $file - Syntax OK"
    else
        echo "❌ $file - Syntax Error"
        error_count=$((error_count + 1))
    fi
done

if [ $error_count -eq 0 ]; then
    echo ""
    echo "🎉 All PHP files have valid syntax!"
else
    echo ""
    echo "❌ Found $error_count PHP syntax errors"
    exit 1
fi

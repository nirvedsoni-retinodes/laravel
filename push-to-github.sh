#!/bin/bash

echo "🚀 PUSHING LARAVEL BOOKING PLATFORM TO GITHUB"
echo "=============================================="
echo ""

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "❌ Git repository not initialized!"
    echo "Run: git init"
    exit 1
fi

# Check if we have commits
if ! git log --oneline -1 > /dev/null 2>&1; then
    echo "❌ No commits found!"
    echo "Run: git add . && git commit -m 'Initial commit'"
    exit 1
fi

echo "✅ Git repository ready"
echo ""

# Get GitHub username
echo "📝 Enter your GitHub username:"
read -r github_username

if [ -z "$github_username" ]; then
    echo "❌ GitHub username is required!"
    exit 1
fi

echo ""
echo "🔗 Repository URL will be: https://github.com/$github_username/laravel-booking-platform"
echo ""

# Add remote origin
echo "🔗 Adding remote origin..."
git remote add origin "https://github.com/$github_username/laravel-booking-platform.git"

# Push to GitHub
echo "📤 Pushing to GitHub..."
git push -u origin main

if [ $? -eq 0 ]; then
    echo ""
    echo "🎉 SUCCESS! Your Laravel Booking Platform is now on GitHub!"
    echo ""
    echo "📋 Repository Details:"
    echo "   �� URL: https://github.com/$github_username/laravel-booking-platform"
    echo "   📁 Name: laravel-booking-platform"
    echo "   🔒 Visibility: Public"
    echo ""
    echo "📚 Installation Instructions:"
    echo "   1. Clone: git clone https://github.com/$github_username/laravel-booking-platform.git"
    echo "   2. Install XAMPP with PHP 8.1+"
    echo "   3. Extract to htdocs folder"
    echo "   4. Access: http://localhost/laravel-booking-platform/install"
    echo "   5. Follow the 4-step installation wizard"
    echo ""
    echo "🎯 Your booking platform is ready for the world!"
else
    echo ""
    echo "❌ Failed to push to GitHub!"
    echo ""
    echo "🔧 Troubleshooting:"
    echo "   1. Make sure you created the repository on GitHub first"
    echo "   2. Check your GitHub credentials"
    echo "   3. Try: git remote -v (to see remotes)"
    echo "   4. Try: git push -u origin main (manual push)"
fi

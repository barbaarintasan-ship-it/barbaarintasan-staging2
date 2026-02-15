# Fly.io Token Setup Guide

## Overview
This guide explains how to configure fly.io API tokens so that GitHub Actions can automatically deploy your application to fly.io.

## What You Need
- A fly.io account with access to the `barbaarintasan-staging` app
- Admin access to this GitHub repository
- A fly.io API token

## Step-by-Step Instructions

### 1. Get Your Fly.io API Token

There are two ways to get a fly.io API token:

#### Option A: Create via Fly.io Dashboard (Recommended)
1. Go to https://fly.io/dashboard
2. Click on your profile (top right)
3. Go to "Access Tokens"
4. Click "Create token"
5. Give it a name like "GitHub Actions - barbaarintasan-staging"
6. Copy the token (you won't see it again!)

#### Option B: Create via flyctl CLI
```bash
# Install flyctl if you haven't already
curl -L https://fly.io/install.sh | sh

# Login to fly.io
flyctl auth login

# Create a new token
flyctl auth token

# This will output your token - copy it!
```

### 2. Add Token to GitHub Secrets

#### Method 1: GitHub Web Interface (Easiest)
1. Go to your repository: https://github.com/barbaarintasan-ship-it/barbaarintasan-staging2
2. Click on **Settings** (top menu)
3. In the left sidebar, click **Secrets and variables** → **Actions**
4. Click **New repository secret**
5. Fill in:
   - **Name:** `FLY_API_TOKEN`
   - **Secret:** Paste the token you copied from fly.io
6. Click **Add secret**

#### Method 2: GitHub CLI
```bash
# Make sure you have GitHub CLI installed and authenticated
gh auth login

# Add the secret
gh secret set FLY_API_TOKEN --repo barbaarintasan-ship-it/barbaarintasan-staging2

# You'll be prompted to paste your fly.io token
# Paste it and press Enter
```

### 3. Verify the Token is Set

1. Go to https://github.com/barbaarintasan-ship-it/barbaarintasan-staging2/settings/secrets/actions
2. You should see `FLY_API_TOKEN` in the list (the value will be hidden)

### 4. Test the Deployment

The deployment workflow (`.github/workflows/deploy.yml`) is configured to run automatically when you push to the `main` or `create` branches.

To test:
1. Make any small change to the repository
2. Push to `main` or `create` branch
3. Go to https://github.com/barbaarintasan-ship-it/barbaarintasan-staging2/actions
4. You should see a new workflow run starting
5. The workflow should successfully deploy to fly.io

## Deployment Workflow

The deployment is configured in `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Fly.io

on:
  push:
    branches:
      - main
      - create

jobs:
  deploy:
    name: Deploy app
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: superfly/flyctl-actions/setup-flyctl@master
      - run: flyctl deploy --remote-only --no-cache
        env:
          FLY_API_TOKEN: ${{ secrets.FLY_API_TOKEN }}
```

### What Happens:
1. GitHub Actions checks out your code
2. Installs flyctl
3. Uses `FLY_API_TOKEN` to authenticate with fly.io
4. Runs `flyctl deploy` to deploy your app
5. App is deployed to: https://staging.appbarbaarintasan.com

## Managing Other Fly.io Secrets

Besides the GitHub token, your application needs other secrets (database URLs, API keys, etc.). These are configured differently:

### Application Secrets (on Fly.io)

These are set directly in fly.io and are available to your running application:

```bash
# Login to fly.io
flyctl auth login

# Set secrets for your app
flyctl secrets set \
  DATABASE_URL="postgresql://..." \
  SESSION_SECRET="your-secret" \
  AZURE_SPEECH_KEY="abc123" \
  OPENAI_API_KEY="sk-..." \
  --app barbaarintasan-staging
```

### Quick Reference: Common Secrets

See `flyio-secrets.txt` for a complete list of secrets your application needs. The most important ones:

| Secret | Purpose | Required |
|--------|---------|----------|
| `DATABASE_URL` | PostgreSQL connection | ✅ Yes |
| `SESSION_SECRET` | Session encryption | ✅ Yes |
| `OPENAI_API_KEY` | AI content generation | ✅ Yes |
| `AZURE_SPEECH_KEY` | Text-to-speech | ✅ Yes |
| `AZURE_SPEECH_REGION` | TTS region | ✅ Yes |
| `STRIPE_SECRET_KEY` | Payments | ✅ Yes |
| `LIVEKIT_API_KEY` | Voice rooms | ✅ Yes |

## Troubleshooting

### "Error: No access token available"
- The `FLY_API_TOKEN` secret is not set in GitHub
- Follow Step 2 to add it

### "Error: Could not find App"
- The token doesn't have access to `barbaarintasan-staging` app
- Make sure you're using a token from the correct fly.io account
- Check that your fly.io account has access to the app

### "Deployment failed"
- Check the GitHub Actions logs for specific errors
- Common issues:
  - Missing required secrets (DATABASE_URL, etc.)
  - Docker build errors
  - Out of memory during build

### "How do I rotate the token?"
1. Create a new token in fly.io dashboard
2. Update the GitHub secret with the new value
3. The old token can be deleted from fly.io

## Security Best Practices

✅ **DO:**
- Use a token with minimal required permissions
- Rotate tokens periodically (every 3-6 months)
- Store tokens only in GitHub Secrets (never commit to code)
- Use different tokens for different repositories

❌ **DON'T:**
- Never commit tokens to your repository
- Don't share tokens via email or chat
- Don't use personal tokens for production apps
- Don't reuse tokens across multiple apps

## Additional Resources

- [Fly.io Documentation](https://fly.io/docs/)
- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [flyctl CLI Reference](https://fly.io/docs/flyctl/)

## Support

If you have issues:
1. Check the GitHub Actions logs
2. Check the fly.io dashboard for app status
3. Review this guide
4. Contact the development team

---

**Last Updated:** 2026-02-15
**Fly.io App:** barbaarintasan-staging
**Region:** fra (Frankfurt)
**URL:** https://staging.appbarbaarintasan.com

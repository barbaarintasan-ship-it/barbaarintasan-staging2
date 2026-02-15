# GitHub Actions Workflows

This directory contains GitHub Actions workflows for the Barbaarintasan Academy application.

## Available Workflows

### 1. Deploy to Fly.io (`deploy.yml`)
Automatically deploys the application to Fly.io when changes are pushed to the `main` or `create` branches.

**Triggers**: Push to `main` or `create` branches
**Required Secrets**: `FLY_API_TOKEN`

### 2. Run Initial Translation (`run-initial-translation.yml`)
Runs the initial batch translation job to populate English content for the application.

**Triggers**: Manual (workflow_dispatch)
**Required Secrets**: 
- `DATABASE_URL` - PostgreSQL connection string (e.g., `postgres://username:password@host:5432/barbaarintasan`)
- `OPENAI_API_KEY` - OpenAI API key (e.g., `sk-your-openai-api-key`)

#### How to Run

1. **Configure Secrets** (First Time Only):
   - Go to: Repository Settings → Secrets and variables → Actions
   - Add the following secrets:
     - `DATABASE_URL`: Your PostgreSQL connection string
     - `OPENAI_API_KEY`: Your OpenAI API key

2. **Run the Workflow**:
   - Go to: Actions → Run Initial Translation
   - Click "Run workflow"
   - (Optional) Provide custom values if you want to override the secrets
   - Click "Run workflow" button

3. **Monitor Progress**:
   - The workflow will install dependencies and run the translation script
   - Check the workflow logs for job IDs and status
   - Translation jobs typically complete within 24 hours

#### What It Does

The workflow will:
1. Set up Node.js environment
2. Install npm dependencies
3. Set required environment variables
4. Run `npm run translate:initial`
5. Create batch translation jobs via OpenAI Batch API
6. Output job IDs for monitoring

For more details, see:
- `INITIAL_TRANSLATION_GUIDE.md` - Comprehensive translation guide
- `scripts/README.md` - Translation scripts documentation

#### Manual Alternative

You can also run the translation script manually on your local machine or server:

```bash
# Set environment variables
export DATABASE_URL="postgres://username:password@host:5432/barbaarintasan"
export OPENAI_API_KEY="sk-your-openai-api-key"

# Run initial translation
npm run translate:initial
```

## Setting Up Secrets

To add repository secrets:

1. Navigate to: `https://github.com/your-org/your-repo/settings/secrets/actions`
2. Click "New repository secret"
3. Add each required secret:
   - Name: `DATABASE_URL`
     Value: `postgres://username:password@host:5432/barbaarintasan`
   - Name: `OPENAI_API_KEY`
     Value: `sk-your-openai-api-key`

## Security Notes

- ⚠️ Never commit API keys or database credentials to the repository
- ✅ Always use GitHub Secrets for sensitive values
- ✅ Workflow inputs allow temporary overrides without modifying secrets
- ✅ Environment variables are not exposed in logs

## Troubleshooting

### Workflow Fails with "Environment variable not found"
- Ensure secrets are properly configured in repository settings
- Check that secret names match exactly: `DATABASE_URL` and `OPENAI_API_KEY`

### Translation Jobs Not Created
- Check workflow logs for detailed error messages
- Verify database connection string is correct
- Ensure OpenAI API key has Batch API access
- Confirm database has content to translate

For more help, see the comprehensive troubleshooting guide in `INITIAL_TRANSLATION_GUIDE.md`.

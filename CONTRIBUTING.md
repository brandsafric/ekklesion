Contributing to Ekklesion
=========================
Ekklesion welcomes contributions to our project.

## Issues
Feel free to submit issues and enhancement requests.

## Contributing
Please refer to [Atlassian's version of github flow](https://www.atlassian.com/blog/archives/simple-git-workflow-simple)
before contributing. In general, we follow the "fork-work-rebase-commit-push" Git workflow.

Also, we encourage you to read the [dev docs](docs/dev/README.md) if you are not
familiar with the project.

1. Fork the repo on GitHub
2. Clone the project to your own machine
3. Create a feature branch from master in the style of `feature/your-feature-name`
4. Commit changes to that branch
5. Every once in a while pull master and then rebase master on your feature branch to
keep it updated with the last changes.
6. When ready, do a last rebase, commit and push.
7. Submit a Pull request so that we can review your changes

### Testing
Please try to unit test every class of the features you create. Also, pull
requests that cover untested classes of the application are very welcomed.

## Using Make
You can commit using `make commit`. This will run the code style fix with licencing info,
run the tests, create the translations file, and create the commit of all the changed files.
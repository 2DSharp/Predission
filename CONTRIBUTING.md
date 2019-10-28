# Contributing

When contributing to this repository, please first discuss the change you wish to make via an issue.
Be nice, be respectful.

## General rules

 -  Commits must be atomic. They should reflect a set of distinct changes as a single operation that solve one problem at a time.
 -  Commit messages must be meaningful, clear and concise. Stress on your grammar, it's fine to google the correct way to say something, English isn't everyone's first language.
 - Commits should do exactly what their message says. If a commit affects quite a few files, and does a few related things, mention them in the commit description. Refrain from using `git commit -m` in such cases.
 -  IDE configuration files/temp files are not meant to be a part of the repository and they should remain so.
 -  Variable names like `a`, `x`, `foo` are unacceptable, use variable names that describes its purpose.
 -  Format the code correctly before submitting a patch. IntelliJ/PHPStorm's auto format option should do it well enough. 
 
 ## Formatting guidelines
 
 - Casing:
    - **camelCase** for method/variable names.
    - **PascalCase** for class name/enum/interface names.
 - Class and method declarations have braces starting in the next line. For everything else, braces start at the end
  of the same line.
 - One space between operators and operands is a must.
 - Make sure a line doesn't exceed 80 characters. 
 
   
## Pull Request Process

 -  Check if there's already a PR assigned to someone that solves a similar problem to yours.
 - Ensure that the pull request is being sent from a hotfix/feature branch and not from `master`.
 - Check the issue page if the feature you are trying to add/bug you are trying to fix is already in the list. If it does, mention the issue number in parentheses with the pull request.
 - Provide a clear, concise description of why this pull request is necessary and what value it adds. Make sure that your PR doesn't contain any more or less than what the PR description says.
 - One PR should do only one thing only. No more, no less. If you want to implement two new features, open two PRs.

---
paths:
  - composer.json
---

# General

## Deploying: gh-pages must already exist as a clean orphan branch
`composer publish` exports to dist/ and pushes it with the gh-pages CLI. If the remote gh-pages branch does not exist, gh-pages creates it from whatever the cached clone has checked out (main), and source files leak into the published branch alongside dist/.

Before the first publish on a new remote, seed a clean orphan branch:
  EMPTY=$(git hash-object -t tree /dev/null)
  git push --force origin "$(git commit-tree $EMPTY -m init)":refs/heads/gh-pages
  rm -rf node_modules/.cache/gh-pages

After every publish, check the branch holds only the dist/ files plus CNAME and .nojekyll.

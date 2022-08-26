# E-Commerce

1. Requirements
2. Run demo
3. Test

## 📋 1. Requirements
- docker-compose
- NodeJs 16.X

## 🦈 2 . Run project

For initial demo, you can use:

```bash
make all
```
This command runs these processes:
1. build
    - Build containers
    - Install dependencies
    - Generate statics files
2. conf-init
    - Create migrations
    - Generate keys from passport
    - Generate key for laravel app
    - Seed database

3. up
    - Init all containers and run on BG.

For default project run on port 8000; you can change on .env
APP_EXPOSE_PORT=XXXX

## 🩺 3 . Test


### All tests

```bash
make test
```
After run all test or feature test. We need run passport:install, its a bug to check.


### Feature tests

```bash
make test/feature
```

### Unit test

```bash
make test/unit
```




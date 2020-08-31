# Payment transactions command

## What's the challenge?
This is a command that, after specifying a customer id by cli, prints his payment transactions in €.

## Run with Docker
Move inside the cloned repository directory and run the command to install the dependencies:
``docker run --rm --interactive --tty --volume $PWD:/app composer install``

Run the container shell:
``docker run --rm --interactive --tty --volume $PWD:/app composer bash``

### Run command
Make cli file executable (optional step):
``chmod +x cli.php``

Run the command:
``./cli.php transactions:report <customer_id>``

If optional step was skipped, run the command:
``php cli.php transactions:report <customer_id>``

### Run tests
Run test suite:
``./bin/phpunit``



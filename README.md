# REST API wrapper for encoding video files

## Installation of RabbitMQ queue handlers

    git clone https://github.com/ricbra/rabbitmq-cli-consumer.git
    cd rabbitmq-cli-consumer
    ./build_service_deb.sh
    #service_name="restencoder-output"
    #cmd="/home/dev/workspace/RestEncoder/app/console -v restencoder:process_queue"
    #queue_name="output_queue"
    dpkg -i restencoder-output_1.1.0_amd64.deb
    /etc/init.d/restencoder-output start
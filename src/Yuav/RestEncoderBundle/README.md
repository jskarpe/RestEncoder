1. Job queued
2. Input downloaded
3. Input parsed and classified
4. Outputs queued
5. Outputs encoded
6. Outputs uploaded
7. Input deleted


Require jquery, bootstrap installed: https://florian.ec/articles/symfony-bower-bootstrap/
npm install less

Run job queue consumer: php app/console rabbitmq:consumer -m 1 job_queue
Run output queue consumer: php app/console rabbitmq:consumer -m 1 output_queue

Get development swift instance running:

  http://stacksync.org/storage-back-end/openstack-swift-all-in-one
  
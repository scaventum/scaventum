# Build the base image

This base image is built manually and is used to build the image by the pipeline.
If you change anything to the base config, build and push to registry like so:

* Get in the right folder:
`cd .docker/www/base-image`

* Build: `docker build -t git.heyday.net.nz:4567/worksafe/risk-project/base-www:latest .`

* Push: `docker push git.heyday.net.nz:4567/worksafe/risk-project/base-www:latest`
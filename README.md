# Estel's WordPress Page Parts Plugin

`@TODO`

## Plugin Development

I've provided a basic `docker-compose`-based environment to assist with developing the plugin. Run `docker-compose up -d`,
then after everything's been started you can visit `http://localhost:8081` to begin working on the plugin from inside a
running WordPress installation.

When the containers come up for the first time, WordPress' core files will be downloaded to `/wp`.

To stop the development environment, run `docker-compose down`. You can bring it back up later without losing your
WordPress database.

If you want to stop the development environment and destroy the WordPress database as well, then run
`docker-compose down --volumes`.

In addition to the WordPress site, you can also spin up a local IDE at `http://localhost:8080` by running
`docker-compose -f docker-compose.ide.yml up -d`.

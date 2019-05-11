# This file is responsible for configuring your application
# and its dependencies with the aid of the Mix.Config module.
#
# This configuration file is loaded before any dependency and
# is restricted to this project.

# General application configuration
use Mix.Config

config :my_app, TestProjectElixir.Repo, types: TestProjectElixir.PostgresTypes

config :testProject_elixir,
  ecto_repos: [TestProjectElixir.Repo]

# Configures the endpoint
config :testProject_elixir, TestProjectElixirWeb.Endpoint,
  url: [host: "localhost"],
  secret_key_base: "TuEVdLZXOCQVH5bbjnkttN1MZaLW33+YpVHSxdhhR2AmEzBExOnhHnxLju7xUfAw",
  render_errors: [view: TestProjectElixirWeb.ErrorView, accepts: ~w(html json)],
  pubsub: [name: TestProjectElixir.PubSub, adapter: Phoenix.PubSub.PG2]

# Configures Elixir's Logger
config :logger, :console,
  format: "$time $metadata[$level] $message\n",
  metadata: [:request_id]

# Use Jason for JSON parsing in Phoenix
config :phoenix, :json_library, Jason

config :ecto, :json_library, Jason

config :phoenix, :format_encoders, json: Jason

# Import environment specific config. This must remain at the bottom
# of this file so it overrides the configuration defined above.
import_config "#{Mix.env()}.exs"

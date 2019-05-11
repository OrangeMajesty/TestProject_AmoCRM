defmodule TestProjectElixir.Repo do
  use Ecto.Repo,
    otp_app: :testProject_elixir,
    adapter: Ecto.Adapters.Postgres
end

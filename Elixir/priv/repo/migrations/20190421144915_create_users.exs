defmodule TestProjectElixir.Repo.Migrations.CreateUsers do
  use Ecto.Migration

  def change do
    create table(:users) do
      add :inn, :bigint
      add :state, :boolean

      timestamps()
    end

  end
end

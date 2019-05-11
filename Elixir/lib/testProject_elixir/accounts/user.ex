defmodule TestProjectElixir.Accounts.User do
  use Ecto.Schema
  import Ecto.Changeset

  schema "users" do
    field :inn, :integer  
    field :state, :boolean

    timestamps()
  end

  @doc false
  def changeset(user, attrs) do
    user
    |> cast(attrs, [:inn, :state, :inserted_at])
  end
end

defmodule TestProjectElixirWeb.PageController do
  use TestProjectElixirWeb, :controller

  alias TestProjectElixir.Accounts
  alias TestProjectElixir.Accounts.User
  alias TestProjectElixir.Validate

  def index(conn, _params) do
    render(conn, "index.html")
  end

  def create(conn, %{"user" => user_params}) do
    case Accounts.create_user(Accounts.isValid(user_params)) do
      {:ok, user} ->
        conn
        |> put_flash(:info, "User created successfully.")
        render(conn, "index.html")
    end
  end

end

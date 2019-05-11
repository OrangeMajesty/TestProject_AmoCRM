defmodule TestProjectElixirWeb.PageControllerTest do
  use TestProjectElixirWeb.ConnCase


  # @inn_attrs_10 %{"inn" => "1234567890"}

  # @invalid_attrs %{inn: "String"}

  test "GET /", %{conn: conn} do
    conn = get(conn, "/")
    assert html_response(conn, 200) =~ ~r/Welcome to Phoenix!/i
  end

 #  test "create/2 with a valid value creates a user" do
	# # conn = get(build_conn(), :index)
 #  	# assert {:ok, %User{} = user} = PageController.create(conn, user_params) 
 #  	PageController.create(conn,  %{"user" => @inn_attrs_10}) 
 #  end
	
end
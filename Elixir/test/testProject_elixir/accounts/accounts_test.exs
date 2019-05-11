defmodule TestProjectElixir.AccountsTest do
  use TestProjectElixir.DataCase

  alias TestProjectElixir.Accounts
  alias TestProjectElixirWeb.PageController

  describe "users" do
    alias TestProjectElixir.Accounts.User

    def user_fixture(attrs \\ %{}) do
      {:ok, user} =
        attrs
        |> Accounts.create_user()

      user
    end

    test "list_users/0 returns all users" do

      inn_attrs_12_valid = %{inn: 616608929424}

      user = user_fixture(inn_attrs_12_valid)

      assert Accounts.list_users() == [user]

    end

    test "create_user/1 with a invalid value creates a user" do

      invalid_attrs = %{inn: "String"}

      assert {:error, _} = Accounts.create_user(invalid_attrs)

    end

    test "create_user/1 with a valid 10 digit number creates a user" do

      inn_attrs_10_valid = %{inn: 7712040126}

      assert {:ok, %User{} = user} = Accounts.create_user(inn_attrs_10_valid)

      assert user.inn == inn_attrs_10_valid.inn

    end

    test "create_user/1 with a valid 12 digit number creates a user" do

      inn_attrs_12_valid = %{inn: 616608929424}

      assert {:ok, %User{} = user} = Accounts.create_user(inn_attrs_12_valid)

      assert user.inn == inn_attrs_12_valid.inn
      
    end

    test "isValid/1 with a valid 12 digit number check valide INN" do

      inn_attrs_12_valid = %{"inn" => "616608929424"}

      user = Accounts.isValid(inn_attrs_12_valid)

      assert user["inn"] == inn_attrs_12_valid["inn"]
      assert user["state"] == true

    end

    test "isValid/1 with a invalid 12 digit number check valide INN" do

      inn_attrs_12_invalid = %{"inn" => "123456789012"}

      user = Accounts.isValid(inn_attrs_12_invalid)

      assert user["inn"] == inn_attrs_12_invalid["inn"]
      assert user["state"] == false

    end

    test "isValid/1 with a valid 10 digit number check valide INN" do

      inn_attrs_12_valid = %{"inn" => "7712040126"}

      user = Accounts.isValid(inn_attrs_12_valid)

      assert user["inn"] == inn_attrs_12_valid["inn"]
      assert user["state"] == true

    end

    test "isValid/1 with a invalid 10 digit number check valide INN" do

      inn_attrs_10_invalid = %{"inn" => "1234567890"}

      user = Accounts.isValid(inn_attrs_10_invalid)

      assert user["inn"] == inn_attrs_10_invalid["inn"]
      assert user["state"] == false

    end

  end
end

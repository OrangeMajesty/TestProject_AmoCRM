defmodule TestProjectElixir.Accounts do
  @moduledoc """
  The Accounts context.
  """

  import Ecto.Query, warn: false
  alias TestProjectElixir.Repo

  alias TestProjectElixir.Accounts.User

  @doc """
  Returns the list of users.

  ## Examples

      iex> list_users()
      [%User{}, ...]

  """
  def list_users do
    User
    |> order_by(desc: :id)
    |> Repo.all()
  end


  @doc """
  Creates a user.

  ## Examples

      iex> create_user(%{field: value})
      {:ok, %User{}}

      iex> create_user(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """
  def create_user(attrs \\ %{}) do
    %User{}
    |> User.changeset(attrs)
    |> Repo.insert()
  end

  @doc """
  Check validate inn.

  ## Examples

      iex> isValid(%{... status: nil})
      %{... status: true or false}

      iex> create_user(%{field: bad_value})
      {:error, %Ecto.Changeset{}}

  """

  def isValid(attrs \\ %{}) do
    length = String.length(attrs["inn"])

    case length do
      10 -> 
        weights = [2,4,10,3,5,9,4,6,8,0]
        
        summ = Enum.map(0..9, fn item ->
          {v, _} = String.at(attrs["inn"], item) |> Integer.parse
          
          Enum.at(weights, item) * v
        end)

        ost = rem(Enum.sum(summ), 11)

        if (ost > 9) do 
          ost = rem(ost, 10)
        end

        {lastNum, _} = String.at(attrs["inn"], 9) |> Integer.parse

        if(ost == lastNum) do
          Map.put_new(attrs, "state", true)
        else
          Map.put_new(attrs, "state", false)
        end

      12 -> 
        weights_11 = [7,2,4,10,3,5,9,4,6,8,0]
        weights_12 = [3,7,2,4,10,3,5,9,4,6,8,0]

        summ = Enum.map(0..11, fn item ->
          {v, _} = String.at(attrs["inn"], item) |> Integer.parse
          
          Enum.at(weights_12, item) * v
        end)

        ost2 = rem(Enum.sum(summ), 11)

        if (ost2 > 9) do 
          ost2 = rem(ost2, 10)
        end

        summ = Enum.map(0..10, fn item ->
          {v, _} = String.at(attrs["inn"], item) |> Integer.parse
          
          Enum.at(weights_11, item) * v
        end)

        ost1 = rem(Enum.sum(summ), 11)

        if (ost1 > 9) do 
          ost1 = rem(ost1, 10)
        end

        {lastNum1, _} = String.at(attrs["inn"], 10) |> Integer.parse
        {lastNum2, _} = String.at(attrs["inn"], 11) |> Integer.parse

        if(ost1 == lastNum1 and ost2 == lastNum2) do
          Map.put_new(attrs, "state", true)
        else
          Map.put_new(attrs, "state", false)
        end

      _ -> Map.put_new(attrs, "state", false)
        
    end

  end

end

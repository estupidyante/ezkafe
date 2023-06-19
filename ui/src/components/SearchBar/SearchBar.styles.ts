import styled, { StyledComponent } from "styled-components"

export const Wrapper: StyledComponent<"div", any, {}, never> = styled.div`
  .searchInputs {
    display: flex;

    input {
      width: 300px;
      height: 30px;
      background-color: white;
      border: 0;
      border-radius: 1rem;
      border-top-right-radius: 0px;
      border-bottom-right-radius: 0px;
      font-size: 18px;
      padding: 15px;

      &:focus {
        outline: none;
      }
    }

    .searchIcon {
      width: 30px;
      height: 30px;
      background-color: white;
      border-radius: 1rem;
      border-top-left-radius: 0px;
      border-bottom-left-radius: 0px;
      display: grid;
      place-items: center;

      svg {
        cursor: pointer;
        font-size: 1.5rem;
      }
    }
  }
`

export const DataResult: StyledComponent<
  "div",
  any,
  {},
  never
> = styled.div`
  width: 375px;
  height: 200px;
  background-color: white;
  border-radius: 1rem;
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  margin-top: 5px;
  box-shadow: #0004 0px 5px 15px;
  overflow: hidden;
  overflow-y: auto;
  position:absolute;
  z-index:999;
  border-right:1px solid #26140D;
  border-bottom:1px solid #26140D;
  border-left:1px solid #26140D;

  &::-webkit-scrollbar {
    width: 1rem;
  }

  &::-webkit-scrollbar-thumb {
    background: #333;
    border-radius: 1rem;
  }

  .searchResults {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    color: black;
    text-decoration: none;
    padding-left: 10px;
    padding-right: 10px;
    justify-content:space-between;

    &:hover {
      background-color: lightgrey;
    }
  }
`
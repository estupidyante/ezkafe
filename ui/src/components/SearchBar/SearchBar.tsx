import { useState, useRef } from "react"
//! Icons
import { MdClose } from "react-icons/md"
//! Types
import type { DataType } from "./SearchBarInterface"
//! Styles
import { Wrapper, DataResult } from "./SearchBar.styles"
import { URI } from "api"

const SearchBar: React.FC<{ data: DataType[], handleState: any, handleSelected: any }> = ({
  data,
  handleState,
  handleSelected,
}): JSX.Element => {
  const [filteredData, setFilteredData] = useState<DataType[]>([])
  const [wordEntered, setWordEntered] = useState<string>("")

  const inputRef: React.RefObject<HTMLInputElement> =
    useRef<HTMLInputElement>(null)
  window.addEventListener("load", () => inputRef.current?.focus())

  const handleFilter = ({
    target,
  }: React.ChangeEvent<HTMLInputElement>): void => {
    const searchWord: string = target.value.toLowerCase()
    setWordEntered(searchWord)

    const newFilter: DataType[] = data.filter(({ name }): boolean =>
      name.toLowerCase().includes(searchWord)
    )

    if (!searchWord) return setFilteredData([])
    setFilteredData(newFilter)
  }

  const clearInput = (): void => {
    setFilteredData([])
    setWordEntered("")
    inputRef.current?.focus()
  }

  return (
    <Wrapper>
      <div className="searchInputs">
        <input
          type="text"
          placeholder="Search"
          value={wordEntered}
          onChange={handleFilter}
          ref={inputRef}
        />
        <div className="searchIcon">
          {wordEntered.length !== 0 && (
            <MdClose id="clearBtn" onClick={clearInput} />
          )}
        </div>
      </div>
      {filteredData.length !== 0 && (
        <DataResult>
          {filteredData.map(({ name, image }, key) => (
            <button key={key} className="searchResults" onClick={(e) => {
              handleState(true);
              handleSelected(filteredData[key]);
            }}>
              {name}
              <img src={URI + image} alt={name} height={'100%'}/>
            </button>
          ))}
        </DataResult>
      )}
    </Wrapper>
  )
}

export { SearchBar }
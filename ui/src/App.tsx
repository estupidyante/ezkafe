import { useState } from 'react';
import styled, { keyframes } from 'styled-components';

function App() {
  const [count, setCount] = useState(0);

  return (
    <Wrapper>
      <Header>
        <div>
          <div data-overlay></div>
          <LogoLink href="#" target="_self">
            <Logo src="/assets/images/ezkafe-base-white.png" alt="EzKafe logo" />
          </LogoLink>
        </div>
      </Header>
      <h1>EzKafe UI</h1>
      <div>
        <a href="https://vitejs.dev/" target="_blank">
          <p>Vite</p>
        </a>
        <a href="https://axios-http.com/" target="_blank">
          <p>Axios</p>
        </a>
        <a href="https://reactjs.org/" target="_blank">
          <p>React</p>
        </a>
        <a href="https://styled-components.com/" target="_blank">
          <p>Styled-Components</p>
        </a>
        <a href="https://github.com/aleclarson/vite-tsconfig-paths" target="_blank">
          <p>Absolute-Path</p>
        </a>
        <a href="https://recoiljs.org/" target="_blank">
          <p>Recoil</p>
        </a>
        <a
          href="https://tanstack.com/query/v4/?from=reactQueryV3&original=https://react-query-v3.tanstack.com/"
          target="_blank"
        >
          <p>React-Query</p>
        </a>
      </div>
      <Card>
        <button onClick={() => setCount(count => count + 1)}>count is {count}</button>
        <p>
          Edit <code>src/App.tsx</code> and save to test HMR
        </p>
      </Card>
      <ReadTheDocs>Click on the Vite and React logos to learn more</ReadTheDocs>
    </Wrapper>
  );
}

const logoSpinAnime = keyframes`
	from { transform: rotate(0deg); }
	to { transform: rotate(360deg); }
`;

const Wrapper = styled.div`
  background: #F1DEC9;
  max-width: 1280px;
  margin: 0 auto;
  text-align: center;
  padding-top: 115px;
`;

const Header = styled.div`
  background: #5B3216;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  transition: var(--transition-1);
  padding: 1.2em;
  z-index: 4;
`;
const Logo = styled.img`
  width:160px;
  will-change: filter;

  &:hover {
    filter: drop-shadow(0 0 2em #646cffaa);
  }
`;

const LogoLink = styled.a`
  @media (prefers-reduced-motion: no-preference) {
    &:nth-of-type(2) ${Logo} {
      animation: ${logoSpinAnime} infinite 20s linear;
    }
  }
`;

const Card = styled.div`
  padding: 2em;
`;

const ReadTheDocs = styled.p`
  color: #888;
`;

export default App;

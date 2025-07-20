import logo from './logo.svg';
import './App.css';

function App() {
  return (
    <header>
      <img src={logo} className="logo-header" alt="logo" />
      <a href='#'>Меню 1</a>
      <a href='#'>Меню 2</a>
      <a href='#'>Меню 3</a>
      <a href='#'>Меню 4</a>
      <a href='#'>Меню 5</a>
      <input type='search' placeholder='Поиск'/>
      <a href='#'>Вход</a>
      <a className="reg-btn" href='#'>Регистрация</a>
    </header>
  );
}

export default App;

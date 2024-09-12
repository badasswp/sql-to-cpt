import ReactDOM from 'react-dom/client';
import App from './app/App';

const sql = document.getElementById( 'sql-to-cpt' );
const app = ReactDOM.createRoot( sql );
app.render(<App />);

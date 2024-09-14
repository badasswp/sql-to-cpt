import { getRoot } from './utils'
import { createRoot } from 'react-dom/client';

import App from './app/App';

const run = async () => {
  try {
    const root = await getRoot('sql-to-cpt');
    createRoot(root).render(<App />);
  } catch (e) {
    throw new Error(e);
  }
}

run();


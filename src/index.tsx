import { getRoot } from './utils'
import { createRoot } from 'react-dom/client';

import App from './app/App';

const run = async () => {
  try {
    const root = await getRoot('sql');
    createRoot(root).render(<App/>)
  } catch {
    throw new Error('Unable to get Root Container');
  }
}

run();


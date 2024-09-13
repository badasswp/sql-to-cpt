import { __ } from '@wordpress/i18n';
import apiFetch from '@wordpress/api-fetch';
import { Button } from '@wordpress/components';

import { getModalParams } from '../utils';
import '../styles/app.scss';

const App = () => {
  const handleUpload = (e) => {
    const wpMediaModal = wp.media( getModalParams() );

    const doImport = async () => {
      const { id, url, mime, filename } = wpMediaModal.state().get('selection').first().toJSON();

      const headings = await apiFetch(
        {
          path: '/your-custom-endpoint',
          method: 'POST',
          data: {
            id, url, mime, filename
          },
        }
      )
    };

    wpMediaModal.on( 'select', doImport ).open();
  };

  return (
    <main>
      <Button
        variant="primary"
        onClick={handleUpload}
      >
        { __('Import SQL File', 'sql-to-cpt') }
      </Button>
    </main>
  )
}

export default App;

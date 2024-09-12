import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';

import { getModalParams } from '../utils';
import '../styles/app.scss';

const App = () => {
  const handleUpload = (e) => {
    e.preventDefault();
    const wpMediaModal = wp.media( getModalParams() );

    const doImport = () => {
      const attachment = wpMediaModal.state().get('selection').first().toJSON();
      if ( 'application/json' !== attachment.mime ) {
        console.log( 'Selected file:', attachment );
      }
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

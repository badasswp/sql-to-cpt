import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';

/**
 * Import Button Component.
 *
 * This function returns a JSX component that is
 * used to display the Import Button.
 *
 * @since 1.2.0
 *
 * @returns {JSX.Element}
 */
const ImportButton = ({ parsedSQL, handleUpload, handleImport }): JSX.Element => {
  return (
    <>
      {
        parsedSQL.tableRows.length < 1 ? (
          <Button
            variant="primary"
            onClick={handleUpload}
          >
            { __( 'Upload SQL File', 'sql-to-cpt' ) }
          </Button>
        ) : (
          <Button
            variant="primary"
            onClick={handleImport}
          >
            { __( 'Convert to CPT', 'sql-to-cpt' ) }
          </Button>
        )
      }
    </>
  );
}

export default ImportButton;

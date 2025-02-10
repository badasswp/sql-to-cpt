import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';
import type { MediaFrame } from '@wordpress/media-utils';
import apiFetch from '@wordpress/api-fetch';

import { getModalParams } from '../utils';

interface ImportButtonProps {
  parsedSQL: {
    tableName: string;
    tableRows: any[];
    tableColumns: string[];
  };
  setIsLoading: Function;
  setSqlNotice: Function;
  setParsedSQL: Function;
}

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
const ImportButton = ( props: ImportButtonProps ): JSX.Element => {
  const { parsedSQL, setIsLoading, setSqlNotice, setParsedSQL } = props;

  /**
   * Handle Upload.
   *
   * This function is responsible for opening the
   * WP media modal to enable user select.
   *
   * @since 1.0.0
   *
   * @returns {void}
   */
  const handleUpload = (): void => {
    const wpMediaModal = wp.media( getModalParams() );
    wpMediaModal.on( 'select', () => handleSelect( wpMediaModal ) ).open();
  };

  /**
   * Handle Selection.
   *
   * This function is responsible for handling a
   * selection made by the user.
   *
   * @since 1.0.0
   *
   * @param {MediaFrame} wpMediaModal WP Media Modal.
   * @returns Promise<void>
   */
  const handleSelect = async ( wpMediaModal: MediaFrame ): Promise<void> => {
    const args = wpMediaModal.state().get( 'selection' ).first().toJSON();

    // Reset.
    setSqlNotice( '' );
    setParsedSQL(
      {
        tableName: '',
        tableColumns: [],
        tableRows: [],
      }
    );
    setIsLoading( true );

    // Parse SQL.
    try {
      setParsedSQL(
        await apiFetch(
          {
            path: '/sql-to-cpt/v1/parse',
            method: 'POST',
            data: {
              ...args
            },
          }
        )
      );
      setIsLoading( false );
    } catch ( { message } ) {
      setIsLoading( false );
      setSqlNotice( message );
    }
  };

  /**
   * Handle Import.
   *
   * This function is responsible for handling the
   * import made by the user.
   *
   * @since 1.1.0
   *
   * @returns Promise<void>
   */
  const handleImport = async (): Promise<void> => {
    setIsLoading( true );

    // Import SQL.
    try {
      const url = await apiFetch(
        {
          path: '/sql-to-cpt/v1/import',
          method: 'POST',
          data: {
            ...parsedSQL
          },
        }
      );
      if ( url ) {
        window.location.href = `${url}`
      }
      setIsLoading( false );
    } catch ( { message } ) {
      setIsLoading( false );
      setSqlNotice( message );
    }
  }

  return (
    <>
      {
        parsedSQL.tableRows.length < 1 ? (
          <Button
            variant="primary"
            onClick={ handleUpload }
          >
            { __( 'Upload SQL File', 'sql-to-cpt' ) }
          </Button>
        ) : (
          <Button
            variant="primary"
            onClick={ handleImport }
          >
            { __( 'Convert to CPT', 'sql-to-cpt' ) }
          </Button>
        )
      }
    </>
  );
}

export default ImportButton;

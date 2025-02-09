import apiFetch from '@wordpress/api-fetch';
import { useState } from '@wordpress/element';
import type { MediaFrame } from '@wordpress/media-utils';

import Notice from '../components/Notice';
import ProgressBar from '../components/ProgressBar';
import ImportButton from '../components/ImportButton';
import TableName from '../components/TableName';
import TableColumns from '../components/TableColumns';

import { getModalParams } from '../utils';
import '../styles/app.scss';

interface SQLProps {
  tableName: string;
  tableColumns: string[];
  tableRows: any[];
}

/**
 * App Component.
 *
 * This function returns a JSX component that comprises
 * the Import Button and Fields.
 *
 * @since 1.0.0
 *
 * @returns {JSX.Element}
 */
const App = (): JSX.Element => {
  const [progress, setProgress]   = useState<number>(0);
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const [sqlNotice, setSqlNotice] = useState<string>('');
  const [parsedSQL, setParsedSQL] = useState<SQLProps>(
    {
      tableName: '',
      tableColumns: [],
      tableRows: [],
    }
  );

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
  const handleSelect = async (wpMediaModal: MediaFrame): Promise<void> => {
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
    setProgress( 0 );
    setIsLoading( true );

    // Parse SQL.
    try {
      const progressInterval = setInterval( () => {
        setProgress( ( prev ) => ( prev < 90 ? prev + 10 : prev ) );
      }, 500 );

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

      clearInterval( progressInterval );
      setProgress( 100 );
      setIsLoading( false );
    } catch ( { message } ) {
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
    setProgress( 0 );
    setIsLoading( true );

    try {
      const progressInterval = setInterval( () => {
        setProgress( ( prev ) => ( prev < 90 ? prev + 10 : prev ) );
      }, 500 );

      const url = await apiFetch(
        {
          path: '/sql-to-cpt/v1/import',
          method: 'POST',
          data: {
            ...parsedSQL
          },
        }
      );

      clearInterval( progressInterval );
      setProgress( 100 );

      if ( url ) {
        window.location.href = `${url}`
      }
    } catch ( { message } ) {
      setSqlNotice( message );
    }
  }

  return (
    <main>
      <ImportButton
        parsedSQL={ parsedSQL }
        handleImport={ handleImport }
        handleUpload={ handleUpload }
      />
      <Notice message={ sqlNotice } />
      <ProgressBar
        progress={ progress }
        isLoading={ isLoading }
      />
      <TableName
        parsedSQL={ parsedSQL }
      />
      <TableColumns
        parsedSQL={ parsedSQL }
      />
    </main>
  )
}

export default App;

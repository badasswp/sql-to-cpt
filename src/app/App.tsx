import { useState } from '@wordpress/element';

import Purge from '../components/Purge';
import Notice from '../components/Notice';
import TableName from '../components/TableName';
import ProgressBar from '../components/ProgressBar';
import TableColumns from '../components/TableColumns';
import ImportButton from '../components/ImportButton';

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
  const [ isLoading, setIsLoading ] = useState<boolean>( false );
  const [ sqlNotice, setSqlNotice ] = useState<string>( '' );
  const [ parsedSQL, setParsedSQL ] = useState<SQLProps>(
    {
      tableName: '',
      tableColumns: [],
      tableRows: [],
    }
  );

  return (
    <main>
      <section>
        <ImportButton
          parsedSQL={ parsedSQL }
          setIsLoading={ setIsLoading }
          setSqlNotice={ setSqlNotice }
          setParsedSQL={ setParsedSQL }
        />
        <Purge
          setIsLoading={ setIsLoading }
          setSqlNotice={ setSqlNotice }
        />
      </section>
      <Notice message={ sqlNotice } />
      <ProgressBar
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

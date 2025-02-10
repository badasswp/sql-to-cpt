import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';

interface PurgeProps {
  setIsLoading: Function;
  setSqlNotice: Function;
}

/**
 * Purge Component.
 *
 * This function returns a JSX component that is
 * used to purge the CPT and its contents.
 *
 * @since 1.3.0
 *
 * @param {Object} props - The component props.
 * @param {Function} props.setIsLoading - Function to set the loading state.
 * @param {Function} props.setSqlNotice - Function to set an SQL notice.
 *
 * @returns {JSX.Element}
 */
const Purge = ( { setIsLoading, setSqlNotice }: PurgeProps ): JSX.Element => {
  const [ postType, setPostType ] = useState( '' );

  const handlePurge = async () => {
    setIsLoading( true );

    try {
      await apiFetch(
        {
          path: '/sql-to-cpt/v1/purge',
          method: 'POST',
          data: {
            postType
          },
        }
      );
      setIsLoading( false );
      window.location.reload();
    } catch ( { message } ) {
      setIsLoading( false );
      setSqlNotice( message );
    }
  }

  return (
    <div className="sqlt-purge">
      <select
        onChange={ ( e ) => { setPostType( e.target.value ) } }
      >
        <option>Select CPT</option>
        {
          sqlt.postTypes.map( ( item: string ) => {
            return (
              <option>{ item }</option>
            )
          } )
        }
      </select>
      <Button
        variant="tertiary"
        onClick={ handlePurge }
      >
        { __( 'Purge CPT', 'sql-to-cpt' ) }
      </Button>
    </div>
  );
}

export default Purge;

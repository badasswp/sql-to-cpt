import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';

/**
 * Purge Component.
 *
 * This function returns a JSX component that is
 * used to purge the CPT and its contents.
 *
 * @since 1.3.0
 *
 * @returns {JSX.Element}
 */
const Purge = ({ setIsLoading, setSqlNotice }): JSX.Element => {
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
    } catch ( { message } ) {
      setIsLoading( false );
      setSqlNotice( message );
    }
  }

  return (
    <div className="sqlt-purge">
      <select
        onChange={ () => {} }
      >
        <option>Select CPT</option>
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

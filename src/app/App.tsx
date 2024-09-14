import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';

import { getModalParams } from '../utils';
import '../styles/app.scss';

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
const App = () => {
  const [headings, setHeadings] = useState([]);

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
  const handleModal = () => {
    const wpMediaModal = wp.media( getModalParams() );
    wpMediaModal.on( 'select', () => handleSelect(wpMediaModal) ).open();
  };

  /**
   * Handle Selection.
   *
   * This function is responsible for handling a
   * selection made by the user.
   *
   * @since 1.0.0
   *
   * @param {Object} wpMediaModal WP Media Modal.
   * @returns {void}
   */
  const handleSelect = async (wpMediaModal) => {
    const args = wpMediaModal.state().get('selection').first().toJSON();

    setHeadings(
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
  };

  /**
   * SQL Fields.
   *
   * This function is responsible for generating
   * a list of SQL input fields.
   *
   * @since 1.0.0
   *
   * @returns {JSX.Element}
   */
  const Fields = () => {
    return headings.map((name) => {
      return (
        <p>
          <input type="text" value={name} disabled />
        </p>
      )
    })
  }

  return (
    <main>
      <Button
        variant="primary"
        onClick={handleModal}
      >
        { __('Import SQL File', 'sql-to-cpt') }
      </Button>
      <div>
        {
          headings.length > 0 && (
            <>
              <h3>Columns</h3>
              { Fields() }
            </>
          )
        }
      </div>
    </main>
  )
}

export default App;

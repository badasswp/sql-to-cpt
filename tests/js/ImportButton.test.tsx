import React from 'react';
import { render, screen, fireEvent } from '@testing-library/react';
import '@testing-library/jest-dom';

import ImportButton from '../../src/components/ImportButton';

jest.mock( '@wordpress/i18n', () => ( {
  __: jest.fn( ( arg ) => arg )
} ) );

jest.mock( '@wordpress/components', () => ( {
  Button: jest.fn( ( { children, variant, onClick } ) => {
    return (
      <>
        <button className={ variant } onClick={ onClick }>
          { children }
        </button>
      </>
    )
  } )
} ) );

const setIsLoading = jest.fn();
const setSqlNotice = jest.fn();
const setParsedSQL = jest.fn();

describe( 'ImportButton', () => {
  it( 'renders the button with "Upload SQL File" text', () => {
    const parsedSQL = {
      tableName: 'student',
      tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
      tableRows: [],
    }

    const { container } = render(
      <ImportButton
        parsedSQL={ parsedSQL }
        setIsLoading={ setIsLoading }
        setSqlNotice={ setSqlNotice }
        setParsedSQL={ setParsedSQL }
      />
    );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<button class="primary">Upload SQL File</button>`
    );

    // Assert the button is displayed.
    const uploadButton = screen.getByRole( 'button' );
    expect( uploadButton ).toHaveClass( 'primary' );
    expect( uploadButton ).toBeInTheDocument();
    expect( uploadButton ).toBeInstanceOf( HTMLButtonElement );
  } );

  it( 'renders the button with "Convert to CPT" text', () => {
    const parsedSQL = {
      tableName: 'student',
      tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
      tableRows: [
        [
          1,
          'John Doe',
          37,
          'M',
          'john@doe.com'
        ]
      ]
    }

    const { container } = render(
      <ImportButton
        parsedSQL={ parsedSQL }
        setIsLoading={ setIsLoading }
        setSqlNotice={ setSqlNotice }
        setParsedSQL={ setParsedSQL }
      />
    );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<button class="primary">Convert to CPT</button>`
    );

    // Assert the button is displayed.
    const importButton = screen.getByRole( 'button' );
    expect( importButton ).toHaveClass( 'primary' );
    expect( importButton ).toBeInTheDocument();
    expect( importButton ).toBeInstanceOf( HTMLButtonElement );
  } );
} );

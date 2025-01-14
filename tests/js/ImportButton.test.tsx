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

const handleUpload = jest.fn(
  () => console.log( 'Handle upload fired!' )
);

const handleImport = jest.fn(
  () => console.log( 'Handle import fired!' )
);

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
        handleUpload={ handleUpload }
        handleImport={ handleImport }
      />
    );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<button class="primary">Upload SQL File</button>`
    );

    // Assert the button is displayed.
    const uploadButton = screen.getByRole( 'button' );
    expect( uploadButton ).toHaveClass( 'primary' );
  } );


  it( 'logs "Handle upload fired!" when the upload button is clicked', () => {
    const consoleSpy = jest.spyOn( console, 'log' ).mockImplementation( () => { } );

    const parsedSQL = {
      tableName: 'student',
      tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
      tableRows: []
    }

    const { container } = render(
      <ImportButton
        parsedSQL={ parsedSQL }
        handleUpload={ handleUpload }
        handleImport={ handleImport }
      />
    );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<button class="primary">Upload SQL File</button>`
    );

    // Assert the button is displayed.
    const uploadButton = screen.getByRole( 'button' );

    // Click upload button.
    fireEvent.click( uploadButton );

    // Test expectations.
    expect( uploadButton ).toHaveClass( 'primary' );
    expect( consoleSpy ).toHaveBeenCalled();
    expect( consoleSpy ).toHaveBeenCalledWith( 'Handle upload fired!' );
    expect( consoleSpy ).toHaveBeenCalledTimes( 1 );

    // Clean up.
    consoleSpy.mockRestore();
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
        handleUpload={ handleUpload }
        handleImport={ handleImport }
      />
    );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<button class="primary">Convert to CPT</button>`
    );

    // Assert the button is displayed.
    const importButton = screen.getByRole( 'button' );
    expect( importButton ).toHaveClass( 'primary' );
  } );


  it( 'logs "Handle import fired!" when the import button is clicked', () => {
    const consoleSpy = jest.spyOn( console, 'log' ).mockImplementation( () => { } );

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
        handleUpload={ handleUpload }
        handleImport={ handleImport }
      />
    );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<button class="primary">Convert to CPT</button>`
    );

    // Assert the button is displayed.
    const importButton = screen.getByRole( 'button' );

    // Click upload button.
    fireEvent.click( importButton );

    // Test expectations.
    expect( importButton ).toHaveClass( 'primary' );
    expect( consoleSpy ).toHaveBeenCalled();
    expect( consoleSpy ).toHaveBeenCalledWith( 'Handle import fired!' );
    expect( consoleSpy ).toHaveBeenCalledTimes( 1 );

    // Clean up.
    consoleSpy.mockRestore();
  } );
} );

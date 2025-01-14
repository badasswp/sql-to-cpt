import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';

import TableName from '../../src/components/TableName';

jest.mock( '@wordpress/i18n', () => ( {
  __: jest.fn( ( arg ) => arg )
} ) );

describe( 'TableName', () => {
  it( 'renders the Table Name and its input', () => {
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

    const { container } = render( <TableName parsedSQL={ parsedSQL } /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<div class="sqlt-cpt-table-name" role="list"><h3>Table</h3><p><input type="text" disabled="" value="student"></p></div>`
    );

    // Assert the Table Name is displayed.
    const tableName = screen.getByRole( 'list' );
    expect( tableName ).toHaveClass( 'sqlt-cpt-table-name' );
    expect( tableName ).toBeInTheDocument();
    expect( tableName ).toBeInstanceOf( HTMLDivElement );
  } );

  it( 'DOES NOT render the Table Name', () => {
    const parsedSQL = {
      tableName: '',
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

    const { container } = render( <TableName parsedSQL={ parsedSQL } /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe( `` );
  } );
} );

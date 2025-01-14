import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';

import TableColumns from '../../src/components/TableColumns';

jest.mock( '@wordpress/i18n', () => ( {
  __: jest.fn( ( arg ) => arg )
} ) );

describe( 'TableColumns', () => {
  it( 'renders the Table Columns', () => {
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

    const { container } = render( <TableColumns parsedSQL={ parsedSQL } /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<div class="sqlt-cpt-table-columns" role="list"><h3>Columns</h3><p><input type="text" disabled="" value="id"></p><p><input type="text" disabled="" value="name"></p><p><input type="text" disabled="" value="age"></p><p><input type="text" disabled="" value="sex"></p><p><input type="text" disabled="" value="email_address"></p></div>`
    );

    // Assert the Table Columns are displayed.
    const tableColumns = screen.getByRole('list');
    expect( tableColumns ).toHaveClass( 'sqlt-cpt-table-columns' );
    expect( tableColumns ).toBeInTheDocument();
    expect( tableColumns ).toBeInstanceOf( HTMLDivElement );
    expect( tableColumns ).toContainHTML( '<h3>Columns</h3><p><input type="text" disabled="" value="id"></p><p><input type="text" disabled="" value="name"></p><p><input type="text" disabled="" value="age"></p><p><input type="text" disabled="" value="sex"></p><p><input type="text" disabled="" value="email_address"></p>' );
  } );

  it( 'DOES NOT render the Table Columns', () => {
    const parsedSQL = {
      tableName: 'student',
      tableColumns: [],
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

    const { container } = render( <TableColumns parsedSQL={ parsedSQL } /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe( `` );
  } );
} );

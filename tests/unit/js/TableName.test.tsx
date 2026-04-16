import { render, screen } from '@testing-library/react';
import { TableName } from '../../../src/components/All';

import { useSelect } from '@wordpress/data';

jest.mock( '@wordpress/data', () => ( {
	useSelect: jest.fn(),
} ) );

jest.mock( '@wordpress/i18n', () => ( {
	__: ( text: string ) => text,
} ) );

jest.mock( '../../../src/components/Disabled', () => ( {
	__esModule: true,
	default: ( { name }: { name: string } ) => (
		<div data-testid="disabled">{ name }</div>
	),
} ) );

const mockUseSelect = useSelect as jest.Mock;

describe( 'TableName component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders table name when available', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {
				tableName: 'student',
				tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
				tableRows: [ [ 1, 'John Doe', 37, 'M', 'john@doe.com' ] ],
			},
		} );

		render( <TableName /> );

		( expect( screen.getByText( 'Table' ) ) as any ).toBeInTheDocument();
		( expect( screen.getByTestId( 'disabled' ) ) as any ).toHaveTextContent(
			'student'
		);
	} );

	it( 'does not render when tableName is empty', () => {
		mockUseSelect.mockReturnValue( { parsedSQL: {} } );

		render( <TableName /> );

		(
			expect( screen.queryByText( 'Table' ) ) as any
		 ).not.toBeInTheDocument();
		(
			expect( screen.queryByTestId( 'disabled' ) ) as any
		 ).not.toBeInTheDocument();
	} );
} );

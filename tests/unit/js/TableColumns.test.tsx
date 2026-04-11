import { render, screen } from '@testing-library/react';
import { TableColumns } from '../../../src/components/All';

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
		<div data-testid={ name }>{ name }</div>
	),
} ) );

const mockUseSelect = useSelect as jest.Mock;

describe( 'TableColumns component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders table columns', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {
				tableName: 'student',
				tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
				tableRows: [ [ 1, 'John Doe', 37, 'M', 'john@doe.com' ] ],
			},
		} );

		render( <TableColumns /> );

		( expect( screen.getByText( 'Columns' ) ) as any ).toBeInTheDocument();
		( expect( screen.getByTestId( 'id' ) ) as any ).toHaveTextContent(
			'id'
		);
		( expect( screen.getByTestId( 'name' ) ) as any ).toHaveTextContent(
			'name'
		);
		( expect( screen.getByTestId( 'age' ) ) as any ).toHaveTextContent(
			'age'
		);
		( expect( screen.getByTestId( 'sex' ) ) as any ).toHaveTextContent(
			'sex'
		);
		(
			expect( screen.getByTestId( 'email_address' ) ) as any
		 ).toHaveTextContent( 'email_address' );
	} );

	it( 'does not render table columns if empty', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {
				tableName: 'student',
				tableColumns: [],
				tableRows: [ [ 1, 'John Doe', 37, 'M', 'john@doe.com' ] ],
			},
		} );

		render( <TableColumns /> );

		(
			expect( screen.queryByText( 'Columns' ) ) as any
		 ).not.toBeInTheDocument();
		(
			expect( screen.queryByTestId( 'id' ) ) as any
		 ).not.toBeInTheDocument();
		(
			expect( screen.queryByTestId( 'name' ) ) as any
		 ).not.toBeInTheDocument();
		(
			expect( screen.queryByTestId( 'age' ) ) as any
		 ).not.toBeInTheDocument();
		(
			expect( screen.queryByTestId( 'sex' ) ) as any
		 ).not.toBeInTheDocument();
		(
			expect( screen.queryByTestId( 'email_address' ) ) as any
		 ).not.toBeInTheDocument();
	} );
} );

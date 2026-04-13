import { render, screen, fireEvent } from '@testing-library/react';
import { ImportButton } from '../../src/components/All';
import { handleUpload, handleImport } from '../../src/utils';


import { useSelect } from '@wordpress/data';

jest.mock( '@wordpress/data', () => ( {
	useSelect: jest.fn(),
} ) );

jest.mock( '@wordpress/i18n', () => ( {
	__: ( text: string ) => text,
} ) );

jest.mock( '../../src/utils', () => ( {
	handleUpload: jest.fn(),
	handleImport: jest.fn(),
} ) );

const mockUseSelect = useSelect as jest.Mock;

describe( 'ImportButton component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders the Upload SQL File button', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {},
		} );

		render( <ImportButton /> );

		(
			expect(
				screen.getByRole( 'button', { name: 'Upload SQL File' } )
			) as any
		 ).toBeVisible();
		(
			expect(
				screen.queryByRole( 'button', { name: 'Convert to CPT' } )
			) as any
		 ).not.toBeInTheDocument();
	} );

	it( 'calls handleUpload when the Upload button is clicked', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {},
		} );

		render( <ImportButton /> );

		const uploadButton = screen.getByRole( 'button', {
			name: 'Upload SQL File',
		} );

		( expect( uploadButton ) as any ).toBeVisible();

		fireEvent.click( uploadButton );

		expect( handleUpload ).toHaveBeenCalled();
	} );

	it( 'renders the Convert to CPT button', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {
				tableName: 'student',
				tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
				tableRows: [ [ 1, 'John Doe', 37, 'M', 'john@doe.com' ] ],
			},
		} );

		render( <ImportButton /> );

		(
			expect(
				screen.getByRole( 'button', { name: 'Convert to CPT' } )
			) as any
		 ).toBeVisible();
		(
			expect(
				screen.queryByRole( 'button', { name: 'Upload SQL File' } )
			) as any
		 ).not.toBeInTheDocument();
	} );

	it( 'calls handleImport when the Convert button is clicked', () => {
		mockUseSelect.mockReturnValue( {
			parsedSQL: {
				tableName: 'student',
				tableColumns: [ 'id', 'name', 'age', 'sex', 'email_address' ],
				tableRows: [ [ 1, 'John Doe', 37, 'M', 'john@doe.com' ] ],
			},
		} );

		render( <ImportButton /> );

		const convertButton = screen.getByRole( 'button', {
			name: 'Convert to CPT',
		} );

		( expect( convertButton ) as any ).toBeVisible();

		fireEvent.click( convertButton );

		expect( handleImport ).toHaveBeenCalled();
	} );
} );

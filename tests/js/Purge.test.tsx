import { render, screen, fireEvent } from '@testing-library/react';
import { Purge } from '../../src/components/All';
import { handlePurge } from '../../src/utils';

import { useDispatch } from '@wordpress/data';

jest.mock( '@wordpress/data', () => ( {
	useDispatch: jest.fn(),
} ) );

jest.mock( '@wordpress/i18n', () => ( {
	__: ( text: string ) => text,
} ) );

jest.mock( '../../src/utils', () => ( {
	handlePurge: jest.fn(),
} ) );

// const mockUseDispatch = useDispatch as jest.Mock;
global.sqlt = {
	postTypes: [ 'student', 'teacher' ],
};

describe( 'Purge Component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders the Purge CPT button', () => {
		render( <Purge /> );

		(
			expect( screen.getByRole( 'button', { name: 'Purge CPT' } ) ) as any
		 ).toBeVisible();
	} );

	it( 'calls handlePurge when the Purge CPT button is clicked', () => {
		render( <Purge /> );

		fireEvent.click( screen.getByRole( 'button', { name: 'Purge CPT' } ) );
		expect( handlePurge ).toHaveBeenCalled();
	} );

	it( 'renders the Select CRT dropdown', () => {
		render( <Purge /> );

		( expect( screen.getByRole( 'combobox' ) ) as any ).toBeInTheDocument();
		(
			expect( screen.getByRole( 'option', { name: 'student' } ) ) as any
		 ).toBeInTheDocument();
		(
			expect( screen.getByRole( 'option', { name: 'teacher' } ) ) as any
		 ).toBeInTheDocument();
		( expect( screen.getAllByRole( 'option' ) ) as any ).toHaveLength( 3 );
	} );
} );

import { render, screen, fireEvent } from '@testing-library/react';
import { Purge } from '../../src/components/All';
import { useDispatch } from '@wordpress/data';

jest.mock( '@wordpress/data', () => ( {
	useDispatch: jest.fn(),
} ) );

jest.mock( '@wordpress/i18n', () => ( {
	__: ( text: string ) => text,
} ) );

jest.mock( '@wordpress/api-fetch', () => jest.fn().mockResolvedValue( {} ) );

const mockUseDispatch = useDispatch as jest.Mock;
global.sqlt = {
	postTypes: [ 'student', 'teacher' ],
};

describe( 'Purge Component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders the Purge CPT button', () => {
		mockUseDispatch.mockReturnValue( {
			setIsLoading: jest.fn(),
			setSqlNotice: jest.fn(),
		} );
		render( <Purge /> );

		(
			expect( screen.getByRole( 'button', { name: 'Purge CPT' } ) ) as any
		 ).toBeVisible();
	} );

	it( 'calls handlePurge when the Purge CPT button is clicked', () => {
		const mockSetIsLoading = jest.fn();
		const mockSetSqlNotice = jest.fn();

		( useDispatch as jest.Mock ).mockReturnValue( {
			setIsLoading: mockSetIsLoading,
			setSqlNotice: mockSetSqlNotice,
		} );

		render( <Purge /> );
		fireEvent.click( screen.getByRole( 'button', { name: 'Purge CPT' } ) );
		expect( mockSetIsLoading ).toHaveBeenCalledWith( true );
	} );
} );

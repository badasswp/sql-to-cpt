import { render, screen } from '@testing-library/react';
import { ProgressBar } from '../../src/components/All';

import { useSelect } from '@wordpress/data';

jest.mock( '@wordpress/data', () => ( {
	useSelect: jest.fn(),
} ) );

jest.mock( '@wordpress/i18n', () => ( {
	__: ( text: string ) => text,
} ) );

const mockUseSelect = useSelect as jest.Mock;

describe( 'ProgressBar component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders the Progress Bar', () => {
		mockUseSelect.mockReturnValue( {
			isLoading: true,
		} );

		render( <ProgressBar /> );

		( expect( screen.getByTestId( 'progress-bar' ) ) as any ).toBeVisible();
	} );

	it( 'does not render table columns if empty', () => {
		mockUseSelect.mockReturnValue( {
			isLoading: false,
		} );

		render( <ProgressBar /> );

		(
			expect( screen.queryByTestId( 'progress-bar' ) ) as any
		 ).not.toBeInTheDocument();
	} );
} );

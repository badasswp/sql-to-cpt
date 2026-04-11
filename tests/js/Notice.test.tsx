import { render, screen } from '@testing-library/react';
import { Notice } from '../../src/components/All';

import { useSelect } from '@wordpress/data';

jest.mock( '@wordpress/data', () => ( {
	useSelect: jest.fn(),
} ) );

jest.mock( '@wordpress/i18n', () => ( {
	__: ( text: string ) => text,
} ) );

const mockUseSelect = useSelect as jest.Mock;

describe( 'Notice component', () => {
	afterEach( () => {
		jest.clearAllMocks();
	} );

	it( 'renders the failed notice if any from API response', () => {
		mockUseSelect.mockReturnValue( {
			sqlNotice: 'Fatal Error! Wrong file type: sample-1.png',
		} );

		render( <Notice /> );

		(
			expect(
				screen.getByText( 'Fatal Error! Wrong file type: sample-1.png' )
			) as any
		 ).toBeVisible();
	} );

	it( 'does not render any notice if empty', () => {
		mockUseSelect.mockReturnValue( {
			sqlNotice: '',
		} );

		render( <Notice /> );

		(
			expect(
				screen.queryByText(
					'Fatal Error! Wrong file type: sample-1.png'
				)
			) as any
		 ).not.toBeInTheDocument();
	} );
} );

/* eslint-disable no-undef */
import '@testing-library/jest-dom';

jest.mock( '@wordpress/components', () => ( {
	Button: ( props ) => <button { ...props } />,
} ) );

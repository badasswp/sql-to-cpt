import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';

import TextInput from '../../src/components/TextInput';

describe( 'TextInput', () => {
  it( 'renders the component with correct text', () => {
    const { container } = render( <TextInput name="post_title" /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<p><input type="text" value="post_title"></p>`
    );

    // Assert the input is rendered and is disabled
    const input = screen.getByRole( 'textbox' );
    expect( input ).toHaveValue( 'post_title' );
    expect( input ).toBeInTheDocument();
    expect( input ).toBeInstanceOf( HTMLInputElement );
  } );
} );

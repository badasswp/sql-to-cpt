import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';

import Notice from '../../src/components/Notice';

describe( 'Notice', () => {
  it( 'renders the component with correct text', () => {
    const { container } = render( <Notice message="Fatal Error! Wrong file type: sample-1.png" /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<nav>Fatal Error! Wrong file type: sample-1.png</nav>`
    );

    // Assert the text content is rendered inside the nav element.
    const nav = screen.getByText( 'Fatal Error! Wrong file type: sample-1.png' );
    const navName = nav.tagName.toLowerCase();
    expect( navName ).toBe( 'nav' );
    expect( nav ).toBeInTheDocument();
    expect( nav ).toBeInstanceOf( HTMLElement );
  } );

  it( 'DOES NOT render the Notice', () => {
    const { container } = render( <Notice message="" /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe( `` );
  } );
} );

import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';

import ProgressBar from '../../src/components/ProgressBar';

describe( 'ProgressBar', () => {
  it( 'renders the Progress Bar', () => {
    const { container } = render( <ProgressBar isLoading={true} progress={75} /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe(
      `<div class="sqlt-cpt-progress-bar" role="progressbar"><div><div style="width: 75%;"></div></div><p>75%</p></div>`
    );

    // Assert the ProgressBar is rendered and is disabled
    const progressBar = screen.getByRole( 'progressbar' );
    expect( progressBar ).toBeInTheDocument();
    expect( progressBar ).toBeInstanceOf( HTMLDivElement );
    expect( progressBar ).toContainHTML( '<div><div style="width: 75%;"></div></div><p>75%</p>' );
  } );


  it( 'DOES NOT render the Progress Bar', () => {
    const { container } = render( <ProgressBar isLoading={false} progress={75} /> );

    // Expect Component to look like so:
    expect( container.innerHTML ).toBe( `` );
  } );
} );

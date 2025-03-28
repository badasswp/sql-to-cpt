import { useState, useEffect } from '@wordpress/element';

interface ProgressBarProps {
	isLoading: boolean;
}

/**
 * Progress Bar Component.
 *
 * This function returns a JSX component that is
 * used to display a Progress Bar.
 *
 * @since 1.2.0
 * @since 1.3.0 Implement Interval logic.
 *
 * @param {Object}           props           - The component props.
 * @param {ProgressBarProps} props.isLoading - True|False.
 *
 * @return {JSX.Element} The Progress Bar component.
 */
const ProgressBar = ( { isLoading }: ProgressBarProps ): JSX.Element => {
	const [ progress, setProgress ] = useState< number >( 0 );

	useEffect( () => {
		let progressInterval: string | number | NodeJS.Timeout;

		if ( isLoading ) {
			setProgress( 0 );
			progressInterval = setInterval( () => {
				setProgress( ( prev ) => ( prev < 90 ? prev + 10 : prev ) );
			}, 500 );
		} else {
			setProgress( 0 );
			clearInterval( progressInterval );
		}

		return () => clearInterval( progressInterval );
	}, [ isLoading ] );

	return (
		<>
			{ isLoading && (
				<div className="sqlt-cpt-progress-bar" role="progressbar">
					<div>
						<div style={ { width: `${ progress }%` } } />
					</div>
					<p>{ progress }%</p>
				</div>
			) }
		</>
	);
};

export default ProgressBar;

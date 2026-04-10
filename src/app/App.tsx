import {
	ImportButton,
	Notice,
	ProgressBar,
	Purge,
	TableName,
	TableColumns,
} from '../components/All';
import '../store';
import '../styles/app.scss';

/**
 * App Component.
 *
 * This function returns a JSX component that comprises
 * the Import Button and Fields.
 *
 * @since 1.0.0
 *
 * @return {JSX.Element} The App component.
 */
const App = (): JSX.Element => {
	return (
		<main>
			<section>
				<ImportButton />
				<Purge />
			</section>

			<Notice />
			<ProgressBar />
			<TableName />
			<TableColumns />
		</main>
	);
};

export default App;

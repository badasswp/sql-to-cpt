/**
 * ProgressBar Component.
 *
 * This function returns a JSX component that is
 * used to display a Progress Bar.
 *
 * @since 1.2.0
 *
 * @returns {JSX.Element}
 */
const ProgressBar = ({ isLoading, progress }) => {
  return (
    <>
      {
        isLoading && (
          <div className="sqlt-cpt-progress-bar">
            <div>
              <div style={{ width: `${progress}%` }} />
            </div>
            <p>{progress}%</p>
          </div>
        )
      }
    </>
  );
}

export default ProgressBar;
